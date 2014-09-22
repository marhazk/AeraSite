/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.IO.Protocol.ProtocolException;
/*    */ import com.goldhuman.IO.Protocol.Rpc;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class GetRoleData extends Rpc
/*    */ {
/*    */   public int retcode;
/*    */   public GRoleData value;
/*    */ 
/*    */   public void Server(Rpc.Data argument, Rpc.Data result)
/*    */     throws ProtocolException
/*    */   {
/* 15 */     RoleId arg = (RoleId)argument;
/* 16 */     RoleDataRes res = (RoleDataRes)result;
/*    */   }
/*    */ 
/*    */   public void Client(Rpc.Data argument, Rpc.Data result) throws ProtocolException
/*    */   {
/* 21 */     RoleId arg = (RoleId)argument;
/* 22 */     RoleDataRes res = (RoleDataRes)result;
/* 23 */     synchronized (this)
/*    */     {
/* 25 */       this.retcode = res.retcode;
/* 26 */       if (0 == res.retcode)
/* 27 */         this.value = res.value;
/*    */       else
/* 29 */         this.value = null;
/* 30 */       notify();
/*    */     }
/*    */   }
/*    */ 
/*    */   public void OnTimeout()
/*    */   {
/* 36 */     synchronized (this)
/*    */     {
/* 38 */       this.retcode = 4;
/* 39 */       this.value = null;
/* 40 */       notify();
/*    */     }
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GetRoleData
 * JD-Core Version:    0.6.2
 */