/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.IO.Protocol.ProtocolException;
/*    */ import com.goldhuman.IO.Protocol.Rpc;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class DBModifyRoleData extends Rpc
/*    */ {
/*    */   public int retcode;
/*    */   public DBModifyRoleDataRes datares;
/*    */ 
/*    */   public void Server(Rpc.Data argument, Rpc.Data result)
/*    */     throws ProtocolException
/*    */   {
/* 15 */     DBModifyRoleDataArg arg = (DBModifyRoleDataArg)argument;
/* 16 */     DBModifyRoleDataRes res = (DBModifyRoleDataRes)result;
/*    */   }
/*    */ 
/*    */   public void Client(Rpc.Data argument, Rpc.Data result) throws ProtocolException
/*    */   {
/* 21 */     DBModifyRoleDataArg arg = (DBModifyRoleDataArg)argument;
/* 22 */     DBModifyRoleDataRes res = (DBModifyRoleDataRes)result;
/*    */ 
/* 24 */     synchronized (this)
/*    */     {
/* 26 */       this.retcode = res.retcode;
/* 27 */       this.datares = res;
/* 28 */       notify();
/*    */     }
/*    */   }
/*    */ 
/*    */   public void OnTimeout()
/*    */   {
/* 34 */     synchronized (this)
/*    */     {
/* 36 */       this.retcode = 4;
/* 37 */       notify();
/*    */     }
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.DBModifyRoleData
 * JD-Core Version:    0.6.2
 */