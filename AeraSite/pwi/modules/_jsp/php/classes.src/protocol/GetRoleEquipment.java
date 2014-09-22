/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.IO.Protocol.ProtocolException;
/*    */ import com.goldhuman.IO.Protocol.Rpc;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data.DataVector;
/*    */ 
/*    */ public final class GetRoleEquipment extends Rpc
/*    */ {
/*    */   public int retcode;
/*    */   public Rpc.Data.DataVector equipment;
/*    */ 
/*    */   public void Server(Rpc.Data argument, Rpc.Data result)
/*    */     throws ProtocolException
/*    */   {
/* 16 */     RoleId arg = (RoleId)argument;
/* 17 */     RoleEquipmentRes res = (RoleEquipmentRes)result;
/*    */   }
/*    */ 
/*    */   public void Client(Rpc.Data argument, Rpc.Data result) throws ProtocolException
/*    */   {
/* 22 */     RoleId arg = (RoleId)argument;
/* 23 */     RoleEquipmentRes res = (RoleEquipmentRes)result;
/*    */ 
/* 25 */     synchronized (this)
/*    */     {
/* 27 */       this.retcode = res.retcode;
/* 28 */       if (0 == res.retcode)
/*    */       {
/* 30 */         this.equipment = res.equipment;
/*    */       }
/*    */       else
/*    */       {
/* 34 */         this.equipment = null;
/*    */       }
/* 36 */       notify();
/*    */     }
/*    */   }
/*    */ 
/*    */   public void OnTimeout()
/*    */   {
/* 42 */     synchronized (this)
/*    */     {
/* 44 */       this.retcode = 4;
/* 45 */       this.equipment = null;
/*    */ 
/* 47 */       notify();
/*    */     }
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GetRoleEquipment
 * JD-Core Version:    0.6.2
 */