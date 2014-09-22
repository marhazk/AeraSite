/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.IO.Protocol.ProtocolException;
/*    */ import com.goldhuman.IO.Protocol.Rpc;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class GetRoleStorehouse extends Rpc
/*    */ {
/*    */   public int retcode;
/*    */   public GRoleStorehouse storehouse;
/*    */ 
/*    */   public void Server(Rpc.Data argument, Rpc.Data result)
/*    */     throws ProtocolException
/*    */   {
/* 15 */     RoleId arg = (RoleId)argument;
/* 16 */     RoleStorehouseRes res = (RoleStorehouseRes)result;
/*    */   }
/*    */ 
/*    */   public void Client(Rpc.Data argument, Rpc.Data result) throws ProtocolException
/*    */   {
/* 21 */     RoleId arg = (RoleId)argument;
/* 22 */     RoleStorehouseRes res = (RoleStorehouseRes)result;
/*    */ 
/* 24 */     synchronized (this)
/*    */     {
/* 26 */       this.retcode = res.retcode;
/* 27 */       if (0 == res.retcode)
/* 28 */         this.storehouse = res.value;
/*    */       else
/* 30 */         this.storehouse = null;
/* 31 */       notify();
/*    */     }
/*    */   }
/*    */ 
/*    */   public void OnTimeout()
/*    */   {
/* 37 */     synchronized (this)
/*    */     {
/* 39 */       this.retcode = 4;
/* 40 */       this.storehouse = null;
/* 41 */       notify();
/*    */     }
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GetRoleStorehouse
 * JD-Core Version:    0.6.2
 */